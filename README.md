# Laravel + Api PagBank + Pix + Webhook

This project in Laravel integrates a buy button functionality with the PagBank API to trigger a payment process, generate a QR code, and handle notifications via a webhook.

![image](https://github.com/user-attachments/assets/7d54e21b-5337-4c8e-bc43-3177cc2345bd)

## Overview

The application allows users to trigger a purchase using a "Buy" button in the `ItemController`. Upon purchase, the system sends a request to PagBank's API to generate a QR code for payment. The QR code is then displayed to the user, and once payment is made, a webhook is triggered to notify the system of the completed transaction.

---

## Features

- Trigger a purchase with a "Buy" button.
- Build and send requests to PagBank's API.
- Display QR code for payment.
- Handle payment notifications via webhook.

---

## Installation


<details>
<summary>Click to show details about </summary>


## Installation project
    
1. Clone the repository.
2. Configure environment variables for the PagBank API credentials and Ultrahook credentials.

```bash
git clone [repository-url]
composer install
npm install
```


## Getting Credentials

## 1. Create an Account in PagBank to Use the API in Sandbox

To begin using PagBank's API in a sandbox environment, follow these steps:

1. **Create a PagBank Account**:  
   Go to the [PagBank website](https://pagseguro.uol.com.br/) and create an account to access the sandbox environment for testing purposes.
   
2. **Generate API Token**:  
   Once logged in, generate an API token for accessing PagBank's sandbox API.

   ![image](https://github.com/user-attachments/assets/1e964919-6e26-479d-aeaf-b72403e3def0)

4. **Configure `.env` File**:  
   After obtaining the API token, update your `.env` file with the following information:
   ```
   PAGSEGURO_ENDPOINT=https://sandbox.api.pagseguro.com/orders
   PAGSEGURO_TOKEN=https:<your-pagbank-api-token>
   ```
   ![image](https://github.com/user-attachments/assets/c383ec81-4092-4b17-a0a0-4ecef8561310)
   
## 2. Create an Account in Ultrahook

Ultrahook is used to expose your local server to the internet for webhook testing.

1. **Create an Ultrahook Account**:  
   Go to the [Ultrahook website](https://www.ultrahook.com/) and sign up for an account.
         ![image](https://github.com/user-attachments/assets/f56c47ab-6de9-4282-a913-a2f3127347bf)
   
3. **Generate API Key**:  
   After logging in, generate your API key. This will be needed to initiate the Ultrahook server.

   ![image](https://github.com/user-attachments/assets/f57517b5-0e00-4cae-a29e-f1e61d29d5b5)

4. **Create a File to Store the API Key**:  
   Create a local file (e.g., `.ultrahook`) to store the API key for easy server initiation. The file content should look like this:
   ```
   api_key=<your-ultrahook-api-key>
   ```

   ![image](https://github.com/user-attachments/assets/c135eb92-c29a-46c0-89de-3d7288db47aa)

   ![image](https://github.com/user-attachments/assets/4dcaa6bc-0262-45e5-ad15-dca181ee30ae)

5. **Configure `.env` File**:
   Update your .env file to include the Ultrahook endpoint that will be used to receive webhook events from PagBank.
   ![image](https://github.com/user-attachments/assets/dd6cccac-c8db-438a-b166-a194a6de7bfb)


## Starting the Development Server

1. Start laravel server.

```bash
php artisan serve
```
1. Start ultrahook server.
   
```bash
ultrahook webhook 8000/webhook
```

</details>

---

## Process Flow

<details>
<summary>Click to show details about </summary>

### 1. **Buy Button Trigger**

The "Buy" button triggers the `buy` action within the `ItemController`.

<details>
<summary>Click to show details about </summary>

![image](https://github.com/user-attachments/assets/f0913b3d-ea62-47ac-ab87-28ded7d18d99)

    
</details>

### 2. **Action Buy: Build Request Body**

In the `buy` action, a request body is constructed (`buildRequestBody`) to send purchase details to PagBank's API.

<details>
<summary>Click to show details about </summary>

![image](https://github.com/user-attachments/assets/173ccd48-315e-4840-9871-e780a5926780)

    
</details>

### 3. **Action Buy: Send Purchase Request**

After the request body is built, the system sends a `sendPurchaseRequest` using cURL to PagBank’s API.

<details>
<summary>Click to show details about </summary>

![image](https://github.com/user-attachments/assets/0046a41c-8d1f-4c38-a880-135e62445585)

    
</details>

### 4. **PagBank API Interaction**

- **Receive Body Request**: PagBank’s API receives the body request sent by the system.
- **Generate QR Code**: Upon successful processing, PagBank returns a response containing a QR code.

<details>
<summary>Click to show details about </summary>
</details>

### 5. **Response from cURL**

- **Successful Response**: If the request is successfully processed, the response will include data with a QR code.
- **Show QR Code**: The QR code is then rendered as an image and displayed to the user.

<details>
<summary>Click to show details about </summary>

![image](https://github.com/user-attachments/assets/d30aec58-adef-43bd-b95e-17e4bdc88c84)

    
</details>

### 6. **QR Code Payment**

Once the user scans and pays via the QR code, PagBank’s API generates a notification confirming the payment.

<details>
<summary>Click to show details about </summary>
</details>

### 7. **Webhook for Payment Notification**

PagBank sends notifications to the `notification_url` specified in the `buildRequestBody`. This webhook is responsible for updating the system on the payment status.


<details>
<summary>Click to show details about </summary>

### Notification Flow

1. **PagSeguro Notifications**: The PagSeguro API sends notifications of completed payments to the URLs listed in the *Notification URLs*.

   ![image](https://github.com/user-attachments/assets/afa85b48-1347-47a8-b20a-5586c03fe87d)

2. **Ultrahook**: The previously created Ultrahook is configured in the *Notification URLs* and will be responsible for receiving these notifications.

   ![image](https://github.com/user-attachments/assets/bd1aeeda-10cd-4161-966e-0e4ae6985e07)

3. **Redirection to Local Server**: The Ultrahook redirects the received notifications to the local server at `http://localhost:8000/webhook`.

   ![image](https://github.com/user-attachments/assets/c67bd5d4-3895-4ddf-baad-dd99500e942e)

4. **POST Request Reception**: The URL `http://localhost:8000/webhook` receives the POST request sent by the Ultrahook.

   ![image](https://github.com/user-attachments/assets/110a630c-5b91-4d25-8de9-e5d25925ba39)

   ![image](https://github.com/user-attachments/assets/47dc94ef-887d-4d0b-8d86-562761f798fc)

6. **Broadcast Update**: Upon receiving the POST request, the server emits a broadcast to a specific channel.

    ![image](https://github.com/user-attachments/assets/64df329d-e258-4647-924c-df4b6075b4ac)

   ![image](https://github.com/user-attachments/assets/3fbbf0f8-a045-4364-9ae9-d31fc696d0c8)


7. **Real-Time Update**: The page listening to the channel receives the broadcast with the notification data and performs a real-time update.

    ![image](https://github.com/user-attachments/assets/662fd346-4079-468e-9a0f-4487a3efc48e)

    
</details>

</details>

---

## Screenshot


![image](https://github.com/user-attachments/assets/204596b1-6495-487b-a082-b4bcbc27640c)

![image](https://github.com/user-attachments/assets/331e1bcb-6a5a-4581-90d9-35678fa99dbc)

![image](https://github.com/user-attachments/assets/9e03f4e6-b438-4579-be26-9ad4c754b3e4)

![image](https://github.com/user-attachments/assets/8c2bcdbe-8174-495e-9cf7-9c6921a511af)


