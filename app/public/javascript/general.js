function delay(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}

async function postForm(url = '', form) {
    const response = await fetch(url, {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      credentials: 'same-origin',
      redirect: 'follow',
      referrerPolicy: 'no-referrer',
      body: form,
    });
    console.log(response);
  }
  
  async function postData(url = '', data = {}) {
    const response = await fetch(url, {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
      },
      redirect: 'follow',
      referrerPolicy: 'no-referrer',
      body: JSON.stringify(data),
    });
    console.log(response);
  }
  
  async function fetchData(path = '') {
    const response = await fetch('http://localhost/api' + path);
    return await response.json();
  }