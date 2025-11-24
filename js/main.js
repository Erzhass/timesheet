
// helper fetch wrapper
async function api(path, opts){
  const res = await fetch(path, opts);
  if(res.headers.get('content-type') && res.headers.get('content-type').includes('application/json')){
    return res.json();
  }
  return res.text();
}
