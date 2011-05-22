-- $Id$

-- RESET
-- TRUNCATE TABLE fin_daybooks;

-- GET ALL
SELECT * FROM fin_object_daybook WHERE book_account = 'cash';

-- COUNT
SELECT COUNT( book_id ) FROM fin_object_daybook; /* 138 */

-- TOTALS
SELECT
COALESCE( SUM( IF( book_type = 'income', book_amount, 0 ) ), 0 ) AS total_income,
COALESCE( SUM( IF( book_type = 'payment', book_amount, 0 ) ), 0 ) AS total_payments,
COALESCE( SUM( IF( book_type = 'income', book_amount, -book_amount) ), 0 ) AS total_balance,
SUM( IF( book_account = 'bank', IF( book_type = 'income', book_amount, 0 ), 0 ) ) AS bank_income,
SUM( IF( book_account = 'bank', IF( book_type = 'payment', book_amount, 0 ), 0 ) ) AS bank_payments,
SUM( IF( book_account = 'bank', IF( book_type = 'income', book_amount, -book_amount ), 0 ) ) AS bank_balance,
SUM( IF( book_account = 'cash', IF( book_type = 'income', book_amount, 0 ), 0 ) ) AS cash_income,
SUM( IF( book_account = 'cash', IF( book_type = 'payment', book_amount, 0 ), 0 ) ) AS cash_payments,
SUM( IF( book_account = 'cash', IF( book_type = 'income', book_amount, -book_amount ), 0 ) ) AS cash_balance
FROM fin_object_daybook;
