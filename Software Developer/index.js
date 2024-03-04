const scriptURL = 'https://script.google.com/macros/s/AKfycbxjdezkgJK8XJQuTXmLIDVUIp5dDcuYC-1GcaC0Mt0haZLFnHfu4qNQlWrVBQO42V0B-w/exec'
    const form = document.forms['submit-to-google-sheet']
    const msg = document.getElementById("msg")
  
    form.addEventListener('submit', e => {
      e.preventDefault()
      fetch(scriptURL, { method: 'POST', body: new FormData(form)})
        .then(response => {
            msg.innerHTML = "Thanks for Submitting"
            setTimeout(function(){
                msg.innerHTML = ""
            },5000)
            form.reset()
        })
        .catch(error => console.error('Error!', error.message))
    })
