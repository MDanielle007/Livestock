export default (await import('vue')).defineComponent({
data() {
return {
Username: '',
Password: '',
ConfirmPassword: '',
Firstname: '',
Middlename: '',
Lastname: '',
dateOfBirth: null,
Gender: '',
CivilStatus: '',
Sitio: '',
Barangay: '',
City: '',
Province: '',
Phone_Number: '',
Email: '',
userType: '',
selectedFile: '',
YearsFarming: '',
Division: '',
Position: '',
TypeFarmer: false,
termsPolicy: false,
registeredUserDialog: false,

step: 1,
items: [
'Personal Information',
'Account Information',
'Additional Information',
'Confirm Registration',
],
};

},
computed: {},
watch: {
'userType'(newValue) {
console.log(newValue);
if (newValue === 'Farmer' || newValue === 'Care Taker') {
this.TypeFarmer = true;
} else {
this.TypeFarmer = false;
}
},
'dateOfBirth'(newValue) {
console.log(newValue);
}
},
components: {
FileUploadInput
},
methods: {
getObjectURL(file) {
if (file) {
return URL.createObjectURL(file);
}
return null;
},
resetInputs() {
this.step = 1;
this.Username = '';
this.Password = '';
this.Firstname = '';
this.Middlename = '';
this.Email = '';
this.ConfirmPassword = '';
this.Lastname = '';
this.dateOfBirth = null;
this.Gender = '';
this.CivilStatus = '';
this.Sitio = '';
this.Barangay = '';
this.City = '';
this.Province = '';
this.Phone_Number = '';
this.Email = '';
this.userType = "";
this.termsPolicy = false;
this.selectedFile = '';
},
async registerUser() {
console.log("Register User");
// Make the Axios request to your backend
try {
this.registeredUserDialog = true;
const formData = new FormData();
formData.append('file', this.selectedFile[0], this.selectedFile[0].name);
formData.append('Username', this.Username);
formData.append('Password', this.Password);
formData.append('Email', this.Email);
formData.append('Firstname', this.Firstname);
formData.append('Middlename', this.Middlename);
formData.append('Lastname', this.Lastname);
formData.append('Date_Of_Birth', this.dateOfBirth);
formData.append('Gender', this.Gender);
formData.append('Civil_Status', this.CivilStatus);
formData.append('Sitio', this.Sitio);
formData.append('Barangay', this.Barangay);
formData.append('City', this.City);
formData.append('Province', this.Province);
formData.append('Phone_Number', this.Phone_Number);
formData.append('User_Role', this.userType);
formData.append('Position', this.Position);
formData.append('Division', this.Division);
formData.append('YearsFarming', this.YearsFarming);


console.log(formData.values);
// const response = await axios.post("admin/registerUserAccount", formData, {
// headers: {
//     'Content-Type': 'multipart/form-data'
// }
// })
// console.log('Headers:', axios.defaults.headers);
// console.log('Request Data:', formData);
// console.log(response);
resetBtn();
} catch (error) {
console.log(error);
}
}
}
});
