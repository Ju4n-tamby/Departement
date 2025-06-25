USE employees;

CREATE OR REPLACE VIEW current_dept_emp_full AS
    SELECT l.emp_no, dept_no, l.from_date, l.to_date, e.first_name, e.last_name, e.gender, e.birth_date
    FROM dept_emp d
    	JOIN employees e
    	ON e.emp_no=d.emp_no
        INNER JOIN dept_emp_latest_date l
        ON d.emp_no=l.emp_no AND d.from_date=l.from_date AND l.to_date = d.to_date;
