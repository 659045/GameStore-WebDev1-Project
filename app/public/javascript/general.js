function delay(time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

async function postForm(url = '', form) {
  try {
    const response = await fetch(url, {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      credentials: 'same-origin',
      redirect: 'follow',
      referrerPolicy: 'no-referrer',
      body: form,
    });

    console.log('postForm Response', response);
  } catch(error) {
    throw error;
  }
}

async function postData(url = '', data = {}) {
  try {
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

    console.log('postData Response', response);
  } catch(error) {
    throw error;
  }
}

async function deleteData(url = '', data = {}) {
  try {
    const response = await fetch(url, {
      method: 'DELETE',
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

    console.log('deleteData Response', response);
  } catch(error) {
    throw error;
  }
}

async function fetchData(path = '') {
  try {
    const response = await fetch('http://localhost/api' + path);
    return await response.json();
  } catch(error) {
    throw error
  }
}