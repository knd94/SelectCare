document.getElementById('scheduleForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const callTitle = document.getElementById('callTitle').value;
    const callDate = document.getElementById('callDate').value;
    const callTime = document.getElementById('callTime').value;

    const scheduledCallEvent = new CustomEvent('scheduleCall', {
        detail: { callTitle, callDate, callTime }
    });
    
    document.dispatchEvent(scheduledCallEvent);
    alert(`Call scheduled!\nTitle: ${callTitle}\nDate: ${callDate}\nTime: ${callTime}`);
    document.getElementById('scheduleForm').reset();
});
