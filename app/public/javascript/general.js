const api = 'http://localhost/api';

function delay(time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

async function postForm(path = '', form) {
  try {
    const response = await fetch(api + path, {
      method: 'POST',
      body: form,
    });

    console.log('postForm Response', response);
    return response;
  } catch(error) {
    throw error;
  }
}

async function postData(path = '', data = {}) {
  try {
    const response = await fetch(api + path, {
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
    const response = await fetch(api + path, {
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
    const response = await fetch(api + path);
    return await response.json();
  } catch(error) {
    throw error
  }
}

function showErrorMessage(message, label) {
  label.classList.remove('warning', 'fade-out');
  label.classList.add('warning');
  label.innerHTML = message;

  setTimeout(() => {
    label.classList.add('fade-out');
    label.innerHTML = '';
  }, 3000);

  return label;
}

function showSuccessMessage(message, label) {
  label.classList.remove('success', 'fade-out');
  label.classList.add('success');
  label.innerHTML = message;

  setTimeout(() => {
    label.classList.add('fade-out');
    label.innerHTML = '';
  }, 3000);

  return label;
}

