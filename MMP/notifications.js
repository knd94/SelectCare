const notificationsData = [
    { id: 1, text: "Hospital Appointment - 4th May, 2024 at 10:00 am" },
    { id: 2, text: "Reminder: Take Medication - Daily at 9:00 am" },
    { id: 3, text: "Family Visit - 6th May, 2024 at 2:00 pm" },
    { id: 4, text: "Reminder: Take Medication - Daily at 9:00 am" },
    { id: 5, text: "Reminder: Carer will visit you - 15th May, 2024 at 11:00 am"}

];
function addNotification(text) {
    const notificationsContainer = document.getElementById('notifications');
    const notificationElement = document.createElement('div');
    notificationElement.classList.add('notification');
    notificationElement.textContent = text;
    notificationsContainer.appendChild(notificationElement);
}


document.addEventListener('DOMContentLoaded', () => {
    notificationsData.forEach(notification => {
        addNotification(notification.text);
    });
    document.addEventListener('scheduleCall', event => {
        const { callTitle, callDate, callTime } = event.detail;
        const scheduledCallText = `Scheduled Call - ${callTitle} on ${callDate} at ${callTime}`;
        addNotification(scheduledCallText);
    });
});
