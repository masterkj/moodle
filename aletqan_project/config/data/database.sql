
use aletqan;

CREATE TABLE `Courseinfo` (
  `cours_id` int(11) UNSIGNED  PRIMARY KEY, 
  `cours_name` varchar(50),
  `have_exam` BOOLEAN,
  `Practical_mark` int(11)
);





CREATE TABLE `Real_cours` (
  `realcours_id` int(11) UNSIGNED  PRIMARY KEY, 
  `cours_id` int(11) UNSIGNED,
  `Teacher_id` int(11),
  `start_date` date,
  `end_date` date,
  `price` int(11),
  `attendance_days`  varchar(255),
    FOREIGN KEY (cours_id) REFERENCES Courseinfo (cours_id)

);


CREATE TABLE `Student_payment` ( 
  `payment_id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  `student_id` int(11),
  `realcours_id` int(11) UNSIGNED,
  `date` date,
  `amount` int(11),
      FOREIGN KEY (realcours_id) REFERENCES Real_cours (realcours_id)

);

