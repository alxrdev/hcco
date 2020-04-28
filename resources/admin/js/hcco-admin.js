
// function that delete a curriculo
const hcco_delete_curriculo = (nonce, id) => {
    httpRequest = new XMLHttpRequest()
    httpRequest.onreadystatechange = () => {
       if ( httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200 ) {
           console.log( 'works' )
       }
    }

    httpRequest.open('GET', `${hcco_ajax_object.ajax_url}?_wpnonce=${nonce}&curriculo_id=${id}&action=${hcco_ajax_object.delete_curriculo_action}`)
    httpRequest.send()
}