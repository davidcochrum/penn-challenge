-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS id_seq;

-- Table Definition
CREATE TABLE "users"
(
    "id"             int4    NOT NULL DEFAULT nextval('id_seq'::regclass),
    "name"           varchar NOT NULL,
    "email"          varchar NOT NULL,
    "points_balance" int4    NOT NULL DEFAULT 0,
    PRIMARY KEY ("id")
);
