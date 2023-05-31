INSERT INTO `author` (`ISBN`, `Author`)
VALUES
  ('9990000011', 'George R. R. Martin'),
  ('9990000021', 'J. K. Rowling'),
  ('9990000031', 'J.R.R. Tolkien'),
  ('9990000041', 'Ernest Hemingway'),
  ('9990000051', 'Jane Austen'),
  ('9990000061', 'Rabindranath Tagore'),
  ('9990000062', 'Rabindranath Tagore'),
  ('9990000071', 'Kazi Nazrul Islam'),
  ('9990000081', 'Humayun Ahmed'),
  ('9990000082', 'Humayun Ahmed'),
  ('9990000083', 'Humayun Ahmed'),
  ('9990000091', 'Samaresh Majumder'),
  ('9990000101', 'Satyajit Ray');



INSERT INTO `book` (`ISBN`, `Title`, `Cost`, `IsReserved`, `Edition`, `PublishedPlace`, `Publisher`, `ReleasedYear`, `GenreName`)
VALUES
  ('9990000011', 'A Game of Thrones', 99.99, 0, 1, 'New York', 'Bantam Spectra', 1996, 'Fantasy'),
  ('9990000021', 'Harry Potter', 149.99, 0, 8, 'London', 'Rowling Publications', 1990, 'Fantasy'),
  ('9990000031', 'The Lord of the Rings', 39.99, 1, 3, 'London', 'Houghton', 1954, 'Fantasy'),
  ('9990000041', 'The Old Man and the Sea', 9.99, 0, 1, 'New York', 'Scribner', 1952, 'Fiction'),
  ('9990000051', 'Pride and Prejudice', 7.99, 1, 1, 'London', 'Penguin Classics', 1813, 'Romance'),
  ('9990000061', 'Noukadubi', 14.99, 0, 1, 'Kolkata', 'Shomoy', 1910, 'Fiction'),
  ('9990000062', 'Gitanjali', 4.99, 0, 1, 'Kolkata', 'Shomoy', 1880, 'Poetry'),
  ('9990000071', 'Sanchita', 18.99, 0, 1, 'Dhaka', 'Prothoma', 1960, 'Poetry'),
  ('9990000081', 'Aj Himur Biye', 9.99, 1, 1, 'Dhaka', 'Prothoma', 2009, 'Romance'),
  ('9990000082', 'Shuvro', 49.99, 0, 1, 'Dhaka', 'Prothoma', 2005, 'Fiction'),
  ('9990000083', 'Opekkha', 29.99, 0, 1, 'Dhaka', 'Prothoma', 2000, 'Fantasy'),
  ('9990000091', 'Kalbela', 19.99, 0, 1, 'Kolkata', 'Rokomari', 1985, 'Romance'),
  ('9990000101', 'Feluda', 99.99, 1, 9, 'Kolkata', 'Onnoprokash', 1922, 'Mystery');


INSERT INTO `genre` (`GenreName`)
VALUES
  ('Fiction'),
  ('Mystery'),
  ('Romance'),
  ('Poetry'),
  ('Fantasy');

INSERT INTO `user` (`Username`, `Password`)
VALUES
  ('sah75', '123'),
  ('msdhoni', '123'),
  ('cr7', '123'),
  ('lm10', '123'),
  ('rafa', '123');

INSERT INTO `user_detail` (`Username`, `Name`, `DOB`, `Email`, `IsDebarred`, `Gender`, `Address`, `IsFaculty`, `Penalty`, `Dept`)
VALUES
  ('sah75', 'Sakib Al Hasan', '1980-05-15', 'sah75@google.com', 0, 'M', 'Bangladesh', 0, 0.00, 'Computer Science'),
  ('msdhoni', 'Mahendra Singh Dhoni', '1985-08-22', 'msdhoni@google.com', 0, 'M', 'India', 1, 0.00, 'Electrical Engineering'),
  ('cr7', 'Cristiano Ronaldo', '1988-03-10', 'cr7@google.com', 0, 'M', 'Portugal', 1, 0.00, 'Computer Science'),
  ('lm10', 'Lionel Messi','1990-03-10', 'lm10@google.com', 0, 'M', 'Argentina', 0, 0.00, 'Computer Science'),
  ('rafa', 'Rafael Nadal','1995-03-10', 'rafa@google.com', 0, 'M', 'Spain', 0, 0.00, 'Electrical Engineering');