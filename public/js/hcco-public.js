
jQuery(document).ready(() => {
	let form = jQuery(".wizard-vertical");

	/**
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
	*/

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
		onFinished: function (event, currentIndex) {
			// send the form
			event.target.submit();
		}
	});
	// ,
	// 	onStepChanging: function(event, currentIndex, newIndex) {
	//         //form.validate().settings.ignore = ":disabled,:hidden";
	//         //return form.valid();
	// 	},
	// 	onFinishing: function(event, currentIndex) {
	//         //form.validate().settings.ignore = ":disabled";
	//         //return form.valid();
	//     },
		

	// mask
	jQuery('#cep').mask('00000-000');
	jQuery('#estado').mask('AA');
	jQuery('#telefone_1').mask('(00) 0 0000-0000');
	jQuery('#telefone_2').mask('(00) 0 0000-0000');

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
});