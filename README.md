


# Initial Environment 


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

![image](https://github.com/user-attachments/assets/dd6cccac-c8db-438a-b166-a194a6de7bfb)






# Curl to api

# Api PagSeguro

# Response QR CODE

# QR CODE pay

# WebHook payment

![image](https://github.com/user-attachments/assets/b7e7fada-422d-4158-8b7f-01b1716f57d6)

![image](https://github.com/user-attachments/assets/204596b1-6495-487b-a082-b4bcbc27640c)

![image](https://github.com/user-attachments/assets/331e1bcb-6a5a-4581-90d9-35678fa99dbc)

![image](https://github.com/user-attachments/assets/9e03f4e6-b438-4579-be26-9ad4c754b3e4)

![image](https://github.com/user-attachments/assets/8c2bcdbe-8174-495e-9cf7-9c6921a511af)

