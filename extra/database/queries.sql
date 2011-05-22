-- $Id$

-- RESET
-- TRUNCATE TABLE fin_daybooks;

-- GET ALL
SELECT * FROM fin_object_daybook;

-- TOTALS
SELECT
COALESCE( SUM( IF( book_type = 'income', book_amount, 0 ) ), 0 ) AS total_income,
COALESCE( SUM( IF( book_type = 'payment', book_amount, 0 ) ), 0 ) AS total_payments,
COALESCE( SUM( IF( book_type = 'income', book_amount, -book_amount) ), 0 ) AS total_balance,
COALESCE( IF( book_account = 'bank', SUM( IF( book_type = 'income', book_amount, 0 ) ), 0 ), 0 ) AS bank_income,
COALESCE( IF( book_account = 'bank', SUM( IF( book_type = 'payment', book_amount, 0 ) ), 0 ), 0 ) AS bank_payments,
COALESCE( IF( book_account = 'bank', SUM( IF( book_type = 'income', book_amount, -book_amount ) ), 0 ), 0 ) AS bank_balance,
COALESCE( IF( book_account = 'cash', SUM( IF( book_type = 'income', book_amount, 0 ) ), 0 ), 0 ) AS cash_income,
COALESCE( IF( book_account = 'cash', SUM( IF( book_type = 'payment', book_amount, 0 ) ), 0 ), 0 ) AS cash_payments,
COALESCE( IF( book_account = 'cash', SUM( IF( book_type = 'income', book_amount, -book_amount ) ), 0 ), 0 ) AS cash_balance
FROM fin_object_daybook;
