import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'DevChuva';
  showMore: boolean = false;
  readMore() {
    this.showMore = !this.showMore;
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
      elementsToHide.forEach(function (element) {
        (element as HTMLElement).style.display = 'none';
      });

      // Ajusta a margem superior
      division.style.marginTop = '0';

      // Ajusta o display do division para quando a função for chamada no sendTopic
      division.style.display = 'flex';
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

  expandComments() {
    const commentElement = document.querySelector('.comments-container') as HTMLElement | null;
    const answeredTopicElement = document.querySelector('.answered-topic') as HTMLElement | null;

    // Verifica se todos os elementos foram encontrados
    if (commentElement && answeredTopicElement) {

      // Lógica para ocultar um dos elementos quando o outro estiver visível
      if (commentElement.style.display === 'block') {
        commentElement.style.display = 'none';
        answeredTopicElement.style.display = 'block'
      } else {
        commentElement.style.display = 'block';
        answeredTopicElement.style.display = 'none'
      }
    }
  }
}