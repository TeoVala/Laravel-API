export const createCookie = (name: string, data: string) => {
  document.cookie = name + "=" + data + ';';
}

export const getCookie = (name: string) => {
  const cookies = document.cookie.split(';');
  for (const cookie of cookies) {
    const [key, value] = cookie.split('=');

    if (key == name) {
      return value;
    }
  }
  return null;
}
