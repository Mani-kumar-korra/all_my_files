
ETA: 24 Hrs.
Solution Approach:-
Task 1:

● Create a module with layout and template to add a link to the customer
feedback page in the footer.
Create Customer Feedback Form:
● Create a new page and redirect to that page when the user clicks on that
link.
● Build a form using HTML and Magento form fields for first name, last
name, email, and comment text area.
● form validation .
● Redirect to Home Page After Submission:
● And store user feedback data in a database.
Display Success Message:
● After submission, set a success message in Magento using session
storage.
● Display the success message on the home page.
Add &quot;Customer Feedback&quot; Tab in Admin Panel:
● Create a custom module to Add a new menu item under the &quot;Customers&quot;
menu in the Magento admin panel.
Display Submitted Feedback in Admin Grid:
● Fetch and display the submitted feedback in the grid with sorting,
searching, and pagination capabilities.

Task 2 :

● Create a module to display two buttons approve and disapprove.
● Implement a mechanism to send emails to customers when feedback is
approved or declined.
● Modify the admin grid to include a &quot;Status&quot; column to display the feedback
status (approved or declined).
● Create a custom block to display approved feedback on the home page.
● Place a scroller.(probably using js).

Task 3:

● When a logged-in customer visits the feedback page, fetch their first
name, last name, and email from their customer account.
● Extend the email functionality to send Email to Customer and BCC to Store
Admin
● Place a view link for each record.
● Create a custom admin page to display the feedback details.
● Include &quot;Approve&quot; and &quot;Decline&quot; buttons at the top for admin actions.
