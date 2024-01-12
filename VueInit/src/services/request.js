export async function posts() {
    const respose = await fetch('https://jsonplaceholder.typicode.com/posts');
    const data = await respose.json();
    return data;
}
export async function users() {
    const respose = await fetch('https://jsonplaceholder.typicode.com/users');
    const data = await respose.json();
    return data;
}