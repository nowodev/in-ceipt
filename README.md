# IN-CEIPT

An opinionated invoice and receipt generator

## TODO

- [x] Add ability to prefetch customer from dropdown, which automatically populates other fields
- [x] Validate unit price, subtotal and total as numerals
- [ ] Preview form before creating invoice
- [x] Add back arrow on form pages to return to previous screen
- [ ] Add settings for customizing one's store or company
- [x] Calculate & display subtotal and total in form before sending it to the db
- [x] Make description section on invoice form dynamic for when adding multiple items.
- [x] Validate & insert values from the multi-form section into the db
- [x] Show error message beneath each input field
- [x] Use button to generate serial number
- [x] Delete invoice
- [x] Switch from fontawesome to SVG icons
- [x] Add row => "No Records Found" on invoice index table when there's no invoice
- [x] Confirm dialog before invoice deletion
- [x] Create multiple invoice templates
- [ ] Feature:  Create basic form and advanced form
- [x] Perform CRUD operations on Customers
- [x] Make forms editable
- [ ] Fix bugs:
  - [x] when updating invoice details, values are either not inserted correctly or are duplicated
  - [ ] when updating invoice details, new values can't be added
  - [x] unique validation when updating invoice
  - [ ] resetForm() removes all dynamic fields on invoice edit page
- [x] Send mails to the customers
- [x] Option to update user's data in settings
