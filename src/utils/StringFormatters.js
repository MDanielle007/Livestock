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
