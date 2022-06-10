# Parspack Server Managment Clean Architecture

A brief description of what this project does and who it's for

## Installation

Install project with composer

```bash
  git clone
  cd
  composer install
  php artisan migrate --seed
```

#### Environment Variables

To run this project, you will need to add the following environment variables to .env file.
authorization by Laravel Passport package.

```bash
  cp .env.example .env
```

Finally add the settings below to end of file :

note: after the command php artisan migrate --seed run this value settings show you in console

```bash
  PARSPACK_GRANT_TYPE=password
  PARSPACK_CLIENT_ID=2
  PARSPACK_CLIENT_SECRET=
```

#### Authentication

```bash
  username: parspack
  password: 123456
```

