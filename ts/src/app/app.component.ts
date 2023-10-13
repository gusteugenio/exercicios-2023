import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'DevChuva';

  readMore() {
    const dots = document.getElementById('dots');
    const more = document.getElementById('more'); 
    const readMoreBtn = document.querySelector('.btn-show-more'); 

    // Verifica se todos os elementos foram encontrados
    if (dots && more && readMoreBtn) {
        // Verifica se os pontos suspensivos estão visíveis
        if (dots.style.display === "none") {
            // Se estiverem invisíveis, se tornarão visíveis e o conteúdo adicional será ocultado
            dots.style.display = "inline";
            more.style.display = "none";
            // Atualiza o texto do botão
            readMoreBtn.innerHTML = "ver mais";
        } else {
            // Se estiverem visíveis, se tornarão invisíveis e o conteúdo adicional será exibido
            dots.style.display = "none";
            more.style.display = "inline";
            // Atualiza o texto do botão
            readMoreBtn.innerHTML = "ver menos";
        }
    }
}


  createTopic() {
    const createTopicForm = document.querySelector('form') as HTMLFormElement | null;
    const division = document.querySelector('.division') as HTMLElement | null;
    
    // Verifica se todos os elementos foram encontrados
    if (createTopicForm && division) {
        // Mostra o formulário
        createTopicForm.style.display = 'block';
    
        // Oculta elementos
        const elementsToHide = document.querySelectorAll('.btn-create-topic, .create-topic, #add, .message-topics');
        elementsToHide.forEach(function(element) {
            (element as HTMLElement).style.display = 'none';
        });
    
        // Ajusta a margem superior
        division.style.marginTop = '0';

        // Ajusta o display do division para quando a função for chamada no sendTopic
        division.style.display = 'flex;'
    }
  }

  sendTopic() {
    const messageTopics = document.querySelector('.message-topics') as HTMLElement | null;
    const form = document.querySelector('form') as HTMLFormElement | null
    const division = document.querySelector('.division') as HTMLElement | null;
  
    // Verifica se todos os elementos foram encontrados
    if (messageTopics && form && division) {
  
      // Mostra a mensagem de formulário submetido
      messageTopics.style.display = 'block';
      
      // Oculta o formulário
      form.style.display = 'none';

      
      // Oculta o division da tela base
      division.style.display = 'none';

    }
  }
}