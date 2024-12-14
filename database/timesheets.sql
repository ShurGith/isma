-- -------------------------------------------------------------
-- TablePlus 6.0.0(550)
--
-- https://tableplus.com/
--
-- Database: database.sqlite
-- Generation Time: 2024-12-13 22:34:02.9170
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "timesheets";
CREATE TABLE "timesheets" ("id" integer primary key autoincrement not null, "calendar_id" integer not null, "user_id" integer not null, "type" varchar check ("type" in ('work', 'pause')) not null default 'work', "day_in" datetime not null, "day_out" datetime, "created_at" datetime, "updated_at" datetime);

INSERT INTO "timesheets" ("id", "calendar_id", "user_id", "type", "day_in", "day_out", "created_at", "updated_at") VALUES
('1', '1', '1', 'work', '2024-12-12 08:00:00', '2024-12-12 15:00:00', '2024-12-12 15:11:03', '2024-12-12 15:19:40'),
('2', '1', '1', 'pause', '2024-12-12 17:33:00', '2024-12-12 16:31:52', '2024-12-12 15:31:57', '2024-12-12 15:31:57');
