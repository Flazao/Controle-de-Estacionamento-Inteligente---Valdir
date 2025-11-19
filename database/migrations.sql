CREATE TABLE IF NOT EXISTS vehicles (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  plate TEXT NOT NULL UNIQUE,
  type TEXT NOT NULL CHECK (type IN ('carro','moto','caminhao'))
);

CREATE TABLE IF NOT EXISTS parking_records (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  vehicle_id INTEGER NOT NULL,
  entry_at TEXT NOT NULL,
  exit_at TEXT,
  amount REAL,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(id)
);
