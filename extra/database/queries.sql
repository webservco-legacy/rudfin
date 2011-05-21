-- $Id$
SELECT DATE(book_date), book_account, book_type, 
book_amount, book_document, book_notes
FROM fin_daybooks
ORDER BY book_date DESC, book_account ASC, book_type ASC;