### Написать SQL-запросы для PostgreSQL добавления трех полей, изменения одного поля и добавления двух индексов в базу данных размером свыше 100 ГБ и более 8 миллионов строк.

#### * Добавьте три поля в существующую таблицу:
```postgresql
ALTER TABLE products
    ADD COLUMN total numeric,
    ADD COLUMN price numeric,
    ADD COLUMN weight numeric;
```

#### * Измените тип данных существующего поля:
```postgresql
ALTER TABLE products
    ALTER COLUMN count TYPE varchar USING count::varchar;
```

#### * Добавьте два индекса:
```postgresql
CREATE INDEX id_weight ON products (weight);
CREATE INDEX id_count ON products (count);
```