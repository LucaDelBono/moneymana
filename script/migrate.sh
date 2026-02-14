#!/bin/sh
set -e

ENV_FILE="../.env"

if [ ! -f "$ENV_FILE" ]; then
    echo "Errore: file .env non trovato in $ENV_FILE"
    exit 1
fi

. "$ENV_FILE"

DB_CONTAINER=${CONTAINER_NAME_DB}
DB_USER="root"
DB_PASS=${MYSQL_ROOT_PASSWORD}
DB_NAME=${MYSQL_DATABASE}
MIGRATION_DIR="../src/migration"
MIGRATION_TABLE="schema_migrations"

exec_mysql() {
    docker exec -i "$DB_CONTAINER" \
        mysql -u "$DB_USER" --password="$DB_PASS" "$DB_NAME" -N -s -e "$1"
}

# Crea tabella se non esiste
exec_mysql "
CREATE TABLE IF NOT EXISTS $MIGRATION_TABLE (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL UNIQUE,
    executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
"

echo "Controllo migrazioni..."

for file in $(ls -1 "$MIGRATION_DIR"/*.sql 2>/dev/null | sort); do

    [ -e "$file" ] || continue

    filename=$(basename "$file")
    filename_escaped=$(printf "%s" "$filename" | sed "s/'/''/g")

    already_executed=$(exec_mysql \
        "SELECT COUNT(*) FROM $MIGRATION_TABLE WHERE filename='$filename_escaped';")

    if [ "$already_executed" -eq 0 ]; then
        echo "Eseguo: $filename"

        docker exec -i "$DB_CONTAINER" mysql \
            -u "$DB_USER" --password="$DB_PASS" "$DB_NAME" <<EOF
START TRANSACTION;
SOURCE /dev/stdin;
EOF

        # Passiamo il contenuto del file nel container
        docker exec -i "$DB_CONTAINER" mysql \
            -u "$DB_USER" --password="$DB_PASS" "$DB_NAME" < "$file"

        exec_mysql \
            "INSERT INTO $MIGRATION_TABLE (filename) VALUES ('$filename_escaped');"

        echo "Migrazione completata: $filename"
    else
        echo "Già eseguita: $filename"
    fi

done

echo "Migrazioni completate."
