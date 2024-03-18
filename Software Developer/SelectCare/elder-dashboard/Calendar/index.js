$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: "events.php",
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = prompt("Enter Event Title");
            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: { title: title, start: start, end: end },
                    success: function(data) {
                        calendar.fullCalendar('refetchEvents');
                        alert("Added Successfully");
                        window.location.replace("index.html");
                    }
                })
            }
        },
        editable: true,
        eventResize: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "/Calendar/update.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id },
                success: function() {
                    calendar.fullCalendar('refetchEvents');
                    alert('Event Update');
                    window.location.replace("/Calendar/index.html");
                }
            })
        },
        eventDrop: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.title;
            var id = event.id;
            $.ajax({
                url: "/Calendar/update.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id },
                success: function() {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated");
                    window.location.replace("/Calendar/index.html");
                }
            });
        },
        eventClick: function(event) {
            if (confirm("Are you sure you want to remove it?")) {
                var id = event.id;
                $.ajax({
                    url: "/Calendar/delete.php",
                    type: "POST",
                    data: { id: id },
                    success: function() {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Removed");
                        window.location.replace("/Calendar/index.html");
                    }
                })
            }
        }
    });
});
