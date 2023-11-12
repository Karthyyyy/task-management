## Setting Up

- clone the repository to a local folder of your choosing
- cd to that directory
- Run composer install
- Run sail build
- Run sail up -d
- Run mv .env.example .env
- Run sail artisan migrate
- Run sail npm run dev

You should now be up and running!

## Potential Improvements

- There's a lack of comments explaining everything due to the lack of time, I would like to go back and comment everything if I had more time.
- There is no validation or proper error handling, again given more time this would be the top priority to implement next.
- I would generally go through all of the default Vue components that come with Laravel/Jetstream as their default naming conventions are terrible.
- I would have liked to implement a v2 for the API versioning middleware to actually give it a proper test, in theory it should be as easy as adding new folders and a new route file and changing the latest version.
- I implemented the option to add files but didn't have chance to actually finish that off but it should be as easy as adding a file upload to the form, saving files to /storage and saving the paths to the DB.
- Pagination was another thing I planned to get done in this time frame. I think the best way to implement it would have been a purely front end pagination after getting all results for a user since I wouldn't expect a user to have so many tasks that loading them all at once would cause issues for the database and this would reduce repeat database queries.
- Very low priority but the UI/UX is just the default of Jetstream. Completely unimportant for the purposes of a tech test, but I hate it!