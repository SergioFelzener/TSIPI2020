window.onload = () => {

const play_pause_button = document.querySelectorAll('.play-pause-button')
const favorite_button = document.querySelectorAll('.favorite-button')
const volume_button = document.querySelectorAll('.volume-button')

const sample_current_duration = document.querySelector('.current-duration')
const seekbar = document.querySelector('.seekbar')
const sample_total_duration = document.querySelector('.total-duration')

const sample = document.querySelectorAll('.sample-audio')

for(let i = 0; i < sample.length; i++){
    sample[i].id = i
}

for(let i = 0; i < volume_button.length; i++){
    volume_button[i].id = i
}

for(let i = 0; i < play_pause_button.length; i++){
    play_pause_button[i].id = i
}

play_pause_button.forEach(btn => {

    let id = btn.id

    btn.addEventListener('click', () => {

        if(btn.getAttribute('data-pause') == 'paused'){
            btn.firstElementChild.src = '../assets/img/audio/pause-icon.svg'
            btn.dataset.pause = 'playing'
            sample[id].play()
    
    
        }else{
            btn.firstElementChild.src = '../assets/img/audio/play-icon.svg'
            btn.dataset.pause = 'paused'
            sample[id].pause()
    
        }
    
    })

})

favorite_button.forEach(btn => {

    btn.addEventListener('click', () => {

        if(btn.id != 'favorite'){
            btn.id = 'favorite'
            btn.firstElementChild.src = '../assets/img/audio/heart-icon-full.svg'
    
        }else{
            btn.id = ''
            btn.firstElementChild.src = '../assets/img/audio/heart-icon.svg'
        }
    
    })
})


volume_button.forEach(btn => {

    btn.addEventListener('click', (e) => {

        let id = btn.id

        if(btn.getAttribute('data-mute') != 'muted'){
            sample[id].muted = true
            btn.dataset.mute = 'muted'
            btn.firstElementChild.src = '../assets/img/audio/audio-icon-muted.svg'
    
        }else{
            sample[id].muted = false
            btn.dataset.mute = ''
            btn.firstElementChild.src = '../assets/img/audio/audio-icon.svg'
        }
    
    })

})


}