const chatBox = document.getElementById('chat-box');
const userInput = document.getElementById('user-input');

function sendMessage() {
    const userMessage = userInput.value.trim();
    if (userMessage === '') return;

    appendMessage('user', userMessage);
    userInput.value = '';
    getChatbotResponse(userMessage);
}

function appendMessage(sender, message) {
    const messageElement = document.createElement('div');
    messageElement.classList.add(sender === 'user' ? 'user-message' : 'chatbot-message');
    messageElement.textContent = message;

    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
}

async function getChatbotResponse(message) {
    try {
        const response = await fetch('https://api.openai.com/v1/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message }),
        });

        if (response.ok) {
            const data = await response.json();
            const chatbotResponse = data.response;
            appendMessage('chatbot', chatbotResponse);
        } else {
            throw new Error('Failed to get response from ChatGPT');
        }
    } catch (error) {
        console.error('Error:', error);
        appendMessage('chatbot', 'Sorry, I encountered an error. Please try again.');
    }
}
