# Code Test Challange
## _Survey App_

### Register User

To register user, please create a `POST` request to the following url

```
http://localhost:8000/api/v1/register
```
with following parameters `name`, `email` and `password` as form-data.
The following reponse will be returned on success.
```
{
    "user": {
        "id": 1,
        "name": "zuezue",
        "email": "zuezue@gmail.com",
        "created_at": "11 seconds ago"
    },
    "token": "2|FGaS418JtaoGa7VZ82JP0znslvzaxpHQU8Nvyqbz"
}
```

### Login User

To login, please create a `POST` request to the following url

```
http://localhost:8000/api/v1/login
```
with following parameters `email` and `password` as form-data.
The following reponse will be returned on success.
```
{
    "user": {
        "id": 1,
        "name": “zuezue”,
        "email": "zuezue@gmail.com",
        "created_at": "38 minutes ago"
    },
    "token": "3|QKapdaHeLxf7dnDsVZI66zDG4TdOuXX4vMQJtPzW"
}
```

You can use this `token` to create survey forms.


### Creating From

To create form, please create a `POST` request to the following url

```
http://localhost:8000/api/v1/generate-survey-form
```

The request json body should be look like this
```
{
    "name": "My Test Survey",
    "questions": [
       {
            "content": "How many rabbits do you have?",
            "type": "number"
       },
       {
            "content": "What's the name of your first cat"
       },
       {
            "content": "Would you want a new cat?",
            "type": "radio",
            "options": ["Yes", "No"]
       }

    ]
}
```
| Parameter Name | Type | Required |
| ------ | ------ | ------ |
| `name` | text | true |
| `questions` | array of Questions | true |
| `question.content` | text | true |
| `question.type` | text | false |
| `question.options` | text | false |

Question types can be `multiselect`, `number`, `radio`, and `text`.
`question.options` is available only for `multiselect` and `radio` and the vaules should be parsed as string of array.

The following reponse will be returned on success.
```
{
    "url": "http://localhost:8000/form/8d4ac333-9e14-48c1-a178-2a5f55e9ba41",
    "description": "This link is available to public and you can share this link to collect your survey."
}
```

You can use the `url` to share the survery form. All of the fields in the survey form are all `required`.
If you have entered the survey form and submit it, you will receive an email.

### Project Setup

First, copy the content of `.env.example` into the project `.env` and then run 
```
composer install
composer dump-autoload
```

For email sending, `redis` is required to create a email queue job. To run the email queue job
```
php artisan queue:work
```
As the current implemenation uses Gmail as the mailserver, you should turn on less secure mode with your test email. For reference, please visit this [link](https://support.google.com/accounts/answer/6010255?hl=en#zippy=%2Cif-less-secure-app-access-is-on-for-your-account)
