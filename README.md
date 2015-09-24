# notifications-module
A rough sketch of a notifications system. This is NOT a full working project.

#Disclamer
This repository is for personal use. You may use the code for your own projects, but without any warranty whatsoever.

#How to run
Execute `php example.php`
It creates 3 CMS users with different roles and different subscription settings (some are subscribed
to emails, others to SMS messages). It then creates 3 different templates of different types (SMS / Email)
and associates them with different event types (New comment / New article).
Finally it demonstrates how the system would be hooked into an existing CMS. A listener instance is created
and two different Events are fired (one from a article creation controller, another from comment creation controller).
Feel free to add / edit users and templates and examine the results by running:
`php example.php`
Have fun!
