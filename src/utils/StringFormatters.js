export function splitPascalCase(str) {
    // Use a regular expression to match the boundary between uppercase and lowercase letters
    const regex = /(?<=[a-z])(?=[A-Z])/g;

    // Use the regular expression to split the string
    const resultArray = str.split(regex);

    // Check the length of resultArray
    if (resultArray.length > 1) {
        // Join the array with spaces to create a readable string
        return resultArray.slice(1).join(" ");
    }

    // Return the original string if no splitting occurred
    return str;
}

export function formatDateTime(datetimeStr) {
    const dateTime = new Date(datetimeStr);
    const now = new Date();
    const diffInMs = now - dateTime;
    const diffInSec = Math.floor(diffInMs / 1000);
    const diffInMin = Math.floor(diffInSec / 60);
    const diffInHour = Math.floor(diffInMin / 60);
    const diffInDay = Math.floor(diffInHour / 24);

    if (diffInSec < 60) {
        return "just now";
    } else if (diffInMin < 60) {
        return `${diffInSec} sec ago`;
    } else if (diffInHour < 24) {
        return `${diffInHour} hour${diffInHour > 1 ? 's' : ''}  ago`;
    } else if (diffInDay === 1) {
        return "Yesterday";
    } else if (diffInDay < 7) {
        return `${diffInDay} day${diffInDay > 1 ? 's' : ''} ago`;
    } else {
        // If the time exceeds one week, return the datetime in the format 'yy-mm-dd'
        const year = dateTime.getFullYear().toString().slice(-2);
        const month = ("0" + (dateTime.getMonth() + 1)).slice(-2);
        const day = ("0" + dateTime.getDate()).slice(-2);
        return `${year}-${month}-${day}`;
    }
}

export function formatDateLong(datetimeStr) {
    const dateTime = new Date(datetimeStr);
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    console.log(dateTime);

    const dayOfWeek = days[dateTime.getDay()];
    const month = months[dateTime.getMonth()];
    const day = dateTime.getDate();
    const year = dateTime.getFullYear();
    let hours = dateTime.getHours();
    const minutes = dateTime.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours %= 12;
    hours = hours || 12; // Handle midnight (0 hours)

    const formattedDate = `${dayOfWeek}, ${month} ${day}, ${year}, ${hours}:${minutes.toString().padStart(2, '0')} ${ampm}`;
    return formattedDate;
}
