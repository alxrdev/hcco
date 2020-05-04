
// function that remove a curriculo from list
const hcco_remove_curriculo_from_list = id => {
    const row = document.querySelector(`#curriculo_${id}`)
    row.parentNode.parentNode.innerHTML = "<td></td><td><p>Currículo removido.</p></td><td></td><td></td><td></td><td></td>";
}

// function that delete a curriculo
const hcco_delete_curriculo = (nonce, id) => {
    if (!document.confirm('Você realmente deseja remover este currículo?')) {
        return false
    }

    httpRequest = new XMLHttpRequest()
    httpRequest.onreadystatechange = () => {
        if ( httpRequest.readyState === XMLHttpRequest.DONE && httpRequest.status === 200 ) {
            hcco_remove_curriculo_from_list(id)
        }
    }

    httpRequest.open('POST', hcco_ajax_object.ajax_url)
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    httpRequest.send(`action=${hcco_ajax_object.delete_curriculo_action}&_wpnonce=${nonce}&curriculo_id=${id}`)
}