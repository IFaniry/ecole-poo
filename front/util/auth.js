import axios from 'axios';

// async function authenticate(mode='login', email, password) {
//   const url = `http://localhost:8000/api/login`;

//   const response = await axios.post(url, {
//     email: email,
//     password: password,
//     returnSecureToken: true,
//   });

//   const token = response.data.idToken;

//   return token;
// }

// export function createUser(email, password) {
//   return authenticate('signUp', email, password);
// }

export async function login(email, password) {
  const url = `http://localhost:8000/api/login`;

  const response = await axios.post(url, {
    email: email,
    password: password
  });

  const token = response.data.token;

  return token;
}