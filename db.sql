
CREATE TABLE Users (
    id INT PRIMARY KEY IDENTITY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    role ENUM('admin', 'faculty', 'student') NOT NULL
);

CREATE TABLE Departments (
    dept_Id INT PRIMARY KEY IDENTITY,
    DepartmentName VARCHAR(100) NOT NULL
);

CREATE TABLE Faculty (
    id INT PRIMARY KEY IDENTITY,
    user_id INT,
    mobile VARCHAR(15),
    gender ENUM('Male','Female','Other'),
    qualification VARCHAR(100),
    dept_id INT,
    salary DECIMAL(10, 2),
    joining_date DATE,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    FOREIGN KEY (dept_id) REFERENCES Departments(dept_Id) ON DELETE CASCADE
);
-- course table
CREATE TABLE `course` (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(50) NOT NULL,
    course_code VARCHAR(50) UNIQUE NOT NULL,
    dept_id INT,
    faculty_id INT,
    semester INT,
    credits INT NOT NULL,
    FOREIGN KEY (dept_id) REFERENCES department(dept_id) ON DELETE CASCADE,
    FOREIGN KEY (faculty_id) REFERENCES faculty(id) ON DELETE CASCADE
);

CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    dept_id INT,
    full_name VARCHAR(100) NOT NULL,
    roll_no VARCHAR(20) NOT NULL UNIQUE,
    mobile VARCHAR(15),
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    isActive BOOLEAN DEFAULT 1,  -- 1 = active, 0 = inactive
    address VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (dept_id) REFERENCES department(dept_id) ON DELETE CASCADE
);



