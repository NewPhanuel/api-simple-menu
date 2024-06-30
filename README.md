# API Simple Menu

A simple RESTful API for managing menus.

## Table of Contents

- [Description](#description)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Description

This project is a simple RESTful API for managing menus. It allows you to create, read, update, and delete menu items. The API is built using PHP and follows REST principles.

## Features

- Create a new menu item
- Retrieve a list of menu items
- Retrieve a single menu item by ID
- Update an existing menu item
- Delete a menu item

## Installation

To install and run this project locally, follow these steps:

1. **Clone the repository:**

    ```sh
    git clone https://github.com/NewPhanuel/api-simple-menu.git
    cd api-simple-menu
    ```

2. **Install dependencies:**

    Make sure you have [Composer](https://getcomposer.org/) installed. Then run:

    ```sh
    composer install
    ```

3. **Set up your environment:**

    Copy the `.env.example` to `.env` and configure your environment variables:

    ```sh
    cp .env.example .env
    ```

4. **Run the application:**

    You can use PHP's built-in server for development:

    ```sh
    php -S localhost:8000 -t public
    ```

## Usage

To use the API, you can send HTTP requests to the endpoints. Here are some examples using `curl`:

- **Create a new menu item:**

    ```sh
    curl -X POST http://localhost:8000/menu -H "Content-Type: application/json" -d '{"name": "Pizza", "price": 9.99}'
    ```

- **Get a list of menu items:**

    ```sh
    curl http://localhost:8000/menu
    ```

- **Get a single menu item by ID:**

    ```sh
    curl http://localhost:8000/menu/1
    ```

- **Update a menu item:**

    ```sh
    curl -X PUT http://localhost:8000/menu/1 -H "Content-Type: application/json" -d '{"name": "Burger", "price": 5.99}'
    ```

- **Delete a menu item:**

    ```sh
    curl -X DELETE http://localhost:8000/menu/1
    ```

## API Endpoints

- `GET /menu`: Retrieve a list of menu items
- `GET /menu/{id}`: Retrieve a single menu item by ID
- `POST /menu`: Create a new menu item
- `PUT /menu/{id}`: Update an existing menu item
- `DELETE /menu/{id}`: Delete a menu item

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes. Make sure to update tests as appropriate.

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature-name`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature-name`)
5. Open a pull request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

Omamowho Phanuel - [omamowhophanuel@gmail.com](mailto:omamowhophanuel@gmail.com)

Project Link: [https://github.com/NewPhanuel/api-simple-menu](https://github.com/NewPhanuel/api-simple-menu)
