URL-Shortener
=============
The following takes advantage of routes, views, and generators. 
All inputs from the user are validated before initial query request. 

If a url already exists, then it returns the already created shortend url.

The example works locally, taking advantage of a virtual host of http://url.dev



| id            | url                    | shortened  |
| ------------- |:----------------------:|:----------:|
| 1             | http://simplynoise.com/|       1qwc |
| 2             | http://google.com      |        8nb |
| 3             | http://reddit.com      |       1rdm |

