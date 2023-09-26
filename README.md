Requirement :
As an admin user, we should be able to view all the toggle configurations used in
Magento on a single page. It can be a custom page and accessible only to admin users.
We can make it a read-only page with a simple search if possible. The idea is to view the
whole system configuration on a single page. Currently, we can manually review it by
going through app/etc/config.php if the configs are dumped in it.
Loading all the configs with a query on a page can be daunting and takes up more load
time and sometimes time out. So find a way to implement it in a performant optimized
way by reading the config file or creating new file by reusing config dump and use that
to read & render the page.

ETA: 24 hours

Solution approach:-

1. Create a Custom Magento Module:
I’ll create a custom Magento 2 module.
2. Create a Custom Admin Page:
In a module, ill create a custom admin page (backend route) that will be accessible only
to admin users. This can be done by configuring routes in the module's routes.xml file.
3. Read the Configuration Data: Ill try to display the config.xml file data in
in the admin panel page without using a query, probably either by reading the file
directly or by any other alternative approach.
4. Create a Layout File:

I'll create a layout(.xml) file. This will define the structure and content of your page.
5. Ui_compoenet :
I'll display the data using the ui_compoenet grid with search
