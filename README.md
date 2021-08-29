# Example Exercise 9000
The latest and greatest of example exercises.

## Prereqs
 - PHP 8+

## Installation
- Clone this repository.
- cd into the project and run `composer install`
- Rename `.env.example` to `.env`
- Run `php artisan serve`
- Visit `http://localhost:8000`

If you have any issues installing, feel free to shoot me an email at <davisgibson@me.com>.

## Documentation
The challenge of this project was to implement basic CRUD operations on a model by interacting with a file instead of a database.

To do this, some functions are rather unorthodox. For example:
- To update an Example model, it writes an entirely new CSV file containing the updated information.
- To delete an Example model, it does the same thing. (This is the only way to update a single line in a CSV)
- To find an Example model, it gets *all* of the entries and uses Laravel's collection functions to search for it.
- When an example model is created, it collects all of the entries *just* to increment the ID.

All of these atrocities can be found in `app/Example.php`.
These misfortunes can pose real problems in terms of scalability. My expert recommendation would be to *store data in a database*.

That being said, writing this has been a fun experience. I've learned to appreciate SQL in ways I never thought possible.

Thank you for viewing my project, I hope you enjoy.
