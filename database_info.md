create the MySQL query that creates database term_paper from following info:

table client
id - int(11) - primary
first_name - varchar(255)
last_name - varchar(255)
address - text
phone_number - varchar(20)
tax_id - varchar(15)

table account
id - int(11) - primary
customer_id - int(11) - foreign
type - enum('Checking', 'Savings', 'Deposit', 'Credit')
balance - decimal(10,2) - 0.00 by default
opening_date - date - current date by default
status - enum('Active', 'Closed', 'Blocked')

table transaction
id - int(11) - primary
from_id - int(11)
to_id - int(11)
description - text
datetime - datetime - current datetime by default
amount - decimal(10,2)
status - enum('Completed', 'Canceled', 'Blocked', 'Pending')