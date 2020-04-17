




/**
 * Cadastro do curriculo
 */
let form = jQuery(".wizard-vertical");

form.validate({
    errorPlacement: function errorPlacement(error, element) {
        element.before(error);
    },
    rules: {
        nome: "required",
		data_nascimento: "required",
		sexo: "required",
		nacionalidade: "required",
		estado_civil: "required",
		filhos: "required",
		empregado: "required",
		cnh: "required",
		cep: {
			required: true,
			minlength: 9
		},
		estado: {
			required: true,
			minlength: 2
		},
		cidade: "required",
		bairro: "required",
		endereco: "required",
		telefone_1: "required",
		email: {
			required: true,
			email: true
		},
		escolaridade: "required",
		cargos_profissoes: "required",
		pretencao_salarial: "required",
		viagem: "required",
		morar_fora: "required"
    },
    messages : {
		nome: "Por favor, preencha o seu nome",
		data_nascimento: "Por favor, insira a sua data de nascimento",
		sexo: "Por favor, selecione uma opção abaixo",
		nacionalidade: "Por favor, selecione a sua nacionalidade",
		estado_civil: "Por favor selecione o seu estado civil",
		filhos: "Por favor, selecione uma opção abaixo",
		empregado: "Por favor, selecione uma opção abaixo",
		cnh: "Por favor, selecione uma opção abaixo",
		cep: "Por favor, digite o seu cep",
		estado: "Por favor, selecione o seu estado",
		cidade: "Por favor, selecione a sua cidade",
		bairro: "Por favor, insira o seu bairro",
		endereco: "Por favor, digite o seu endereço",
		telefone_1: "Por favor, insira o seu telefone",
		email: "Por favor, insira um email válido, enviaremos menssages para ele",
		escolaridade: "Por favor, selecione a sua escolaridade",
		cargos_profissoes: "Por favor, digite um cargo/profissão",
		pretencao_salarial: "Por favor, selecione uma pretenção salarial",
		viagem: "Por favor, selecione uma opção abaixo",
		morar_fora: "Por favor, selecione uma opção abaixo"
    },
    onfocusout: function(element) {
        jQuery(element).valid();
    },
});

form.steps({
	headerTag: "h3",
	bodyTag: "fieldset",
	transitionEffect: "slideLeft",
	enableAllSteps: true,
	stepsOrientation: "vertical",
	labels: {
        previous: 'Anterior',
        next: 'Próximo',
        finish: 'Continuar',
        current: ''
	},
	onStepChanging: function(event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
	},
	onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
	onFinished: function (event, currentIndex) {
		// send the form
		event.target.submit();
	}
});
	

// mask
jQuery('#cep').mask('00000-000');
jQuery('#estado').mask('AA');
jQuery('#telefone_1').mask('00 00000 0000');
jQuery('#telefone_2').mask('00 00000 0000');

// address
jQuery("input[name=cep]").blur(function(){
	let cep = jQuery(this).val().replace(/[^0-9]/, '');
	if(cep){
		let url = 'https://viacep.com.br/ws/'+ cep +'/json/?callback=?';
		jQuery.ajax({
			url: url,
			dataType: 'json',
			crossDomain: true,
			contentType: "application/json",
			success : function(json){
				if (! json.error) {
					jQuery("#endereco").val("");
					jQuery("#bairro").val("");
					jQuery("#cidade").val("");
					jQuery("#estado").val("");

					jQuery("#endereco").val(json.logradouro);
					jQuery("#bairro").val(json.bairro);
					jQuery("#cidade").val(json.localidade);
					jQuery("#estado").val(json.uf);
				}
			}
		});
	}
});







/**
 * Checkout MP Form
 */
jQuery('#cardNumber').mask('0000 0000 0000 0000 000');
jQuery('#docNumber').mask('000 000 000 00');
jQuery('#cardExpirationMonth').mask('AA');
jQuery('#cardExpirationYear').mask('AAAA');
jQuery('#securityCode').mask('0000');

jQuery('#creditCardPaymentForm').validate({
    errorPlacement: function errorPlacement(error, element) {
        element.before(error);
    },
    onfocusout: function(element) {
        jQuery(element).valid();
    },
    submitHandler: function(form) {
    	// remove todos os atributos name do form
    	jQuery("#creditCardPaymentForm input[type=text]").removeAttr('name');

    	// inicia o processo do MP
    	window.Mercadopago.createToken(jQuery("#creditCardPaymentForm"), sdkResponseHandler);
    }
});
jQuery('#cardNumber').rules('add', {
	required: true,
	minlength: 14,
	maxlength: 23,
	messages: {
		required: "Por favor, insira um cartão válido",
		minlength: "Mínimo 12 dígitos"
	}
});
jQuery('#cardholderName').rules('add', {
	required: true,
	minlength: 1,
	messages: {
		required: "Por favor, insira o nome escrito no cartão"
	}
});
jQuery('#docNumber').rules('add', {
	required: true,
	minlength: 14,
	maxlength: 14,
	messages: {
		required: "Por favor, insira o numero do seu CPF",
		minlength: "Mínimo 11 digitos"
	}
});
jQuery('#cardExpirationMonth').rules('add', {
	required: true,
	minlength: 2,
	maxlength: 2,
	messages: {
		required: "Por favor, insira o mês do cartão",
		minlength: "Mínimo 2 digitos"
	}
});
jQuery('#cardExpirationYear').rules('add', {
	required: true,
	minlength: 4,
	maxlength: 4,
	messages: {
		required: "Por favor, insira o ano do cartão",
		minlength: "Mínimo 4 digitos"
	}
});
jQuery('#securityCode').rules('add', {
	required: true,
	minlength: 3,
	maxlength: 4,
	messages: {
		required: "Por favor, insira o código do cartão",
		minlength: "Mínimo 3 digitos"
	}
});


/**
 * MP Codes
 */
window.Mercadopago.setPublishableKey(hcco_ajax_object.mp_public_key);

// window.Mercadopago.getIdentificationTypes();

document.querySelector('#cardNumber').addEventListener('keyup', guessingPaymentMethod);
document.querySelector('#cardNumber').addEventListener('change', guessingPaymentMethod);

function getBin() {
	const cardnumber = document.querySelector("#cardNumber").value;
	return cardnumber.replace(/[ .-]/g, '').slice(0, 6);
}

function guessingPaymentMethod(event) {
    let bin = getBin();

    if (event.type == "keyup") {
        if (bin.length >= 6) {
            window.Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethodInfo);
        }
    } else {
        setTimeout(function() {
            if (bin.length >= 6) {
                window.Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
}

function setPaymentMethodInfo(status, response) {
    if (status == 200) {
    	// pega o input
        let paymentMethodElement = document.querySelector('input[name=paymentMethodId]');

        // verifica se input existe e insere o id nele
        if (paymentMethodElement) {
            paymentMethodElement.value = response[0].id;
        } else {
			// cria o input e insere no form
			let input = document.createElement("input");
			input.setAttribute("type", "hidden");
			input.setAttribute("name", "paymentMethodId");
			input.setAttribute("value", response[0].id);
            document.querySelector('#creditCardPaymentForm').append(input);
        }

        // insere a bandeira do cartao no input
        document.querySelector("#creditCardPaymentInputIcon").setAttribute('src', response[0].secure_thumbnail);
	}
}

function sdkResponseHandler(status, response) {
    if (status != 200 && status != 201) {
        alert("Ops! verifique os dados preenchidos e tente novamente.");
    }else{
    	// cria o input para o token do cartão gerado
		let token = document.createElement("input");
		token.setAttribute("type", "hidden");
		token.setAttribute("name", "token");
        token.setAttribute("value", response.id);

        // insere o input no form
		let form = document.querySelector('#creditCardPaymentForm');
		form.append(token);

        // envia o formulario
        form.submit();
    }
}
