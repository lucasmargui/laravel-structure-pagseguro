# Curl to API

This project integrates a buy button functionality with the PagBank API to trigger a payment process, generate a QR code, and handle notifications via a webhook.

![image](https://github.com/user-attachments/assets/7d54e21b-5337-4c8e-bc43-3177cc2345bd)

## Overview

The application allows users to trigger a purchase using a "Buy" button in the `ItemController`. Upon purchase, the system sends a request to PagBank's API to generate a QR code for payment. The QR code is then displayed to the user, and once payment is made, a webhook is triggered to notify the system of the completed transaction.

## Features

- Trigger a purchase with a "Buy" button.
- Build and send requests to PagBank's API.
- Display QR code for payment.
- Handle payment notifications via webhook.

---

## Webhook Setup

Ensure that the correct `notification_url` is configured in the request body so that the system can receive payment status updates from PagBank.

## Requirements

- PHP
- cURL
- PagBank API credentials
- Ultrahook API credentials

---

<details>
<summary>Click to show details about </summary>

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

</details>

## Installation

1. Clone the repository.
2. Configure environment variables for the PagBank API credentials.
3. Set up the webhook URL in the PagBank dashboard.

```bash
git clone [repository-url]
composer install
npm install
```

---

## Process Flow

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
</details>

---


