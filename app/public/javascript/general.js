function delay(time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

async function postForm(path = '', form) {
  try {
    const response = await fetch('http://localhost:8888/api' + path, {
      method: 'POST',
      body: form,
    });

    console.log('postForm Response', response);
  } catch(error) {
    throw error;
  }
}

async function postData(path = '', data = {}) {
  try {
    const response = await fetch('http://localhost:8888/api' + path, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    console.log('postData Response', response);
  } catch(error) {
    throw error;
  }
}

async function deleteData(path = '', data = {}) {
  try {
    const response = await fetch('http://localhost:8888/api' + path, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    console.log('deleteData Response', response);
  } catch(error) {
    throw error;
  }
}



async function fetchData(path = '') {
  try {
    //TODO change back to localhost
    const response = await fetch('http://localhost:8888/api' + path);
    return await response.json();
  } catch(error) {
    throw error
  }
}