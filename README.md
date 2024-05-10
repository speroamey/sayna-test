



## SAYNA TEST DESCRIPTION

### Create Models:
 Create models for the entities involved in your system. For Template, Quote, Site, Destination, and User. Define their attributes and methods according to the requirements.
### Create SingletonTrait
 Create a new folder called Traits and add the Singleton file; this will be used as trai in repositories.
### Create repositories
 Create repositories for each model to encapsulate data access logic. Implement methods in the repositories to interact, such as fetching records by ID or creating new records.In this folder there is a Repository class file containing an Interface which will be implemented in others repositories.
### Implement TemplateManagerService: 
  Create a TemplateManagerService class to handle template management logic. Define methods in the service class to process templates, replace placeholders, and compute text based on input data.
### Handle Placeholder Replacement: 
 Inside the TemplateManagerService, implement methods to replace placeholders in template content with dynamic data. For example, replace [quote:destination_name] with the actual destination name.





