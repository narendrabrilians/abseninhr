CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);


CREATE TABLE leave_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    reason TEXT NOT NULL,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

INSERT INTO employees (name, email, password, role)
VALUES ('Admin User', 'admin@abseninhr.com', 'admin123', 'admin');

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    date DATE NOT NULL,
    time_in TIME,
    time_out TIME,
    status ENUM('Present', 'Absent', 'Leave') DEFAULT 'Present',
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- DATA DUMMY TABLE employees --

INSERT INTO employees (name, email, password, role) VALUES
('Karyawan Satu', 'karyawansatu@abseninhr.com', 'karyawansatu', 'user'),
('Karyawan Dua', 'karyawandua@abseninhr.com', 'karyawandua', 'user'),
('Karyawan Tiga', 'karyawantiga@abseninhr.com', 'karyawantiga', 'user');

-- DATA DUMMY TABLE attendance --

-- Absensi karyawansatu (ID 2) employee_id mengikuti di employees
INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES
(2, '2025-05-01', '08:00:00', '17:00:00', 'Present'),
(2, '2025-05-02', '08:05:00', '17:01:00', 'Present'),
(2, '2025-05-03', '08:10:00', '17:05:00', 'Present'),
(2, '2025-05-04', '08:00:00', '17:00:00', 'Present'),
(2, '2025-05-05', '08:15:00', '17:10:00', 'Present'),
(2, '2025-05-06', '08:20:00', '17:00:00', 'Present'),
(2, '2025-05-07', '08:00:00', '17:00:00', 'Present'),
(2, '2025-05-08', '08:00:00', '17:00:00', 'Present'),
(2, '2025-05-09', '08:30:00', '17:20:00', 'Present'),
(2, '2025-05-10', '08:00:00', '17:00:00', 'Present');

-- Absensi karyawandua (ID 3) employee_id mengikuti di employees
INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES
(3, '2025-05-01', '08:10:00', '17:10:00', 'Present'),
(3, '2025-05-02', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-03', '08:20:00', '17:15:00', 'Present'),
(3, '2025-05-04', '08:05:00', '17:00:00', 'Present'),
(3, '2025-05-05', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-06', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-07', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-08', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-09', '08:00:00', '17:00:00', 'Present'),
(3, '2025-05-10', '08:00:00', '17:00:00', 'Present');

-- Absensi karyawantiga (ID 4) employee_id mengikuti di employees
INSERT INTO attendance (employee_id, date, time_in, time_out, status) VALUES
(4, '2025-05-01', '08:05:00', '17:00:00', 'Present'),
(4, '2025-05-02', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-03', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-04', '08:10:00', '17:10:00', 'Present'),
(4, '2025-05-05', '08:15:00', '17:05:00', 'Present'),
(4, '2025-05-06', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-07', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-08', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-09', '08:00:00', '17:00:00', 'Present'),
(4, '2025-05-10', '08:00:00', '17:00:00', 'Present');

-- DATA DUMMY TABLE leave_requests --

-- Pengajuan cuti karyawansatu (employee_id = 2) employee_id mengikuti di employees
INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) VALUES
(2, '2025-05-11', '2025-05-11', 'Cuti pribadi', 'Pending'),
(2, '2025-05-15', '2025-05-16', 'Acara keluarga', 'Approved'),
(2, '2025-05-20', '2025-05-20', 'Keperluan mendesak', 'Rejected'),
(2, '2025-05-25', '2025-05-26', 'Cuti tahunan', 'Pending'),
(2, '2025-05-28', '2025-05-29', 'Urusan administrasi', 'Approved');

-- Pengajuan cuti karyawandua (employee_id = 3) employee_id mengikuti di employees
INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) VALUES
(3, '2025-05-12', '2025-05-12', 'Liburan', 'Pending'),
(3, '2025-05-16', '2025-05-17', 'Kondisi kesehatan', 'Approved'),
(3, '2025-05-21', '2025-05-21', 'Acara keluarga', 'Rejected'),
(3, '2025-05-26', '2025-05-27', 'Cuti biasa', 'Approved'),
(3, '2025-05-29', '2025-05-30', 'Kegiatan sosial', 'Pending');

-- Pengajuan cuti karyawantiga (employee_id = 4) employee_id mengikuti di employees
INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) VALUES
(4, '2025-05-13', '2025-05-13', 'Urusan pribadi', 'Pending'),
(4, '2025-05-17', '2025-05-18', 'Acara kampus', 'Approved'),
(4, '2025-05-22', '2025-05-22', 'Kesehatan mental', 'Rejected'),
(4, '2025-05-27', '2025-05-28', 'Cuti reguler', 'Pending'),
(4, '2025-05-30', '2025-05-31', 'Kepentingan keluarga', 'Approved');
