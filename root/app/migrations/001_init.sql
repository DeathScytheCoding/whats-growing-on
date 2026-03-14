PRAGMA foreign_keys = ON;

CREATE TABLE IF NOT EXISTS locations (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  type TEXT NOT NULL DEFAULT 'unspecified',
  parent_id INTEGER REFERENCES locations(id) ON DELETE SET NULL,
  light_level TEXT,
  notes TEXT
);

CREATE INDEX IF NOT EXISTS idx_locations_parent_id ON locations(parent_id);
CREATE INDEX IF NOT EXISTS idx_locations_name ON locations(name);

CREATE TABLE IF NOT EXISTS plants (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  scientific_name TEXT,
  species TEXT,
  cultivar TEXT,
  acquired_date TEXT,
  location_id INTEGER REFERENCES locations(id) ON DELETE SET NULL,
  status TEXT NOT NULL DEFAULT 'active',
  last_watered_at TEXT,
  last_fertilized_at TEXT,
  notes TEXT
);

CREATE INDEX IF NOT EXISTS idx_plants_location_id ON plants(location_id);
CREATE INDEX IF NOT EXISTS idx_plants_status ON plants(status);
CREATE INDEX IF NOT EXISTS idx_plants_name ON plants(name);

CREATE TABLE IF NOT EXISTS tasks (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL,
  description TEXT,
  task_type TEXT NOT NULL DEFAULT 'general',
  plant_id INTEGER REFERENCES plants(id) ON DELETE CASCADE,
  due_date TEXT,
  status TEXT NOT NULL DEFAULT 'pending',
  priority INTEGER NOT NULL DEFAULT 0,
  recurrence_rule TEXT,
  completed_at TEXT
);

CREATE INDEX IF NOT EXISTS idx_tasks_due_date ON tasks(due_date);
CREATE INDEX IF NOT EXISTS idx_tasks_status ON tasks(status);
CREATE INDEX IF NOT EXISTS idx_tasks_plant_id ON tasks(plant_id);

CREATE TABLE IF NOT EXISTS task_occurrences (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  task_id INTEGER NOT NULL REFERENCES tasks(id) ON DELETE CASCADE,
  completed_at TEXT NOT NULL DEFAULT (datetime('now')),
  notes TEXT
);

CREATE INDEX IF NOT EXISTS idx_task_occurrences_task_id ON task_occurrences(task_id);

CREATE TABLE IF NOT EXISTS plant_checkins (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  plant_id INTEGER NOT NULL REFERENCES plants(id) ON DELETE CASCADE,
  measured_at TEXT NOT NULL DEFAULT (datetime('now')),
  height REAL,
  spread REAL,
  image_path TEXT,
  notes TEXT
);

CREATE INDEX IF NOT EXISTS idx_plant_checkins_plant_id ON plant_checkins(plant_id);
CREATE INDEX IF NOT EXISTS idx_plant_checkins_plant_id_measured_at ON plant_checkins(plant_id, measured_at);
