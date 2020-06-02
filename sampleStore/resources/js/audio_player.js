window.onload = () => {

    setTimeout(function (){
        const play_pause_button = document.querySelectorAll('.play-pause-button')
        const favorite_button = document.querySelectorAll('.favorite-button')
        const volume_button = document.querySelectorAll('.volume-button')
    
        const sample_current_duration = document.querySelectorAll('.current-duration')
        const seekbar = document.querySelectorAll('.seekbar')
        const sample_total_duration = document.querySelectorAll('.total-duration')
    
        const sample = document.querySelectorAll('.sample-audio')
    
        sample.forEach(audio => {
            audio.ontimeupdate = () => {
    
                let id = audio.id
                seekbar[id].value = audio.currentTime
                sample_current_duration[id].innerHTML = "0:0" + sample[id].currentTime.toFixed(0)
    
            }
        })
    
        seekbar.forEach(seekbar => {
    
            seekbar.onchange = (e) => {
                let id = seekbar.id
                sample[id].currentTime = e.target.value
                sample_current_duration[id].innerHTML = "0:0" + sample[id].currentTime.toFixed(0)
            }
    
        })
    
        // Configuring Samples Players
        for (let i = 0; i < sample.length; i++) {
            // Setting unique IDs
            sample[i].id = i
            seekbar[i].id = i
            sample_current_duration[i].id = i
            sample_total_duration[i].id = i
            volume_button[i].id = i
            play_pause_button[i].id = i
    
            // Set sample duration
            seekbar[i].max = sample[i].duration
            console.log(sample[i].duration)
            sample_total_duration[i].innerHTML = "0:0" +  Math.floor(sample[i].duration)
    
            // Set sample current time
            sample_current_duration[i].innerHTML = "0:00"
    
            // Set seekbar position
            seekbar[i].value = 0
    
        }
    
        // Play / Pause btns
        play_pause_button.forEach(btn => {
    
            let id = btn.id
    
            btn.addEventListener('click', () => {
    
                if (btn.getAttribute('data-pause') == 'paused') {
                    btn.firstElementChild.src = '../assets/img/audio/pause-icon.svg'
                    btn.dataset.pause = 'playing'
                    sample[id].play()
    
    
                } else {
                    btn.firstElementChild.src = '../assets/img/audio/play-icon.svg'
                    btn.dataset.pause = 'paused'
                    sample[id].pause()
    
                }
    
            })
    
        })
    
        // Favorite btns
        favorite_button.forEach(btn => {
    
            btn.addEventListener('click', () => {
    
                if (btn.id != 'favorite') {
                    btn.id = 'favorite'
                    btn.firstElementChild.src = '../assets/img/audio/heart-icon-full.svg'
    
                } else {
                    btn.id = ''
                    btn.firstElementChild.src = '../assets/img/audio/heart-icon.svg'
                }
    
            })
        })
    
        // Volume ON / OFF btns
        volume_button.forEach(btn => {
    
            btn.addEventListener('click', (e) => {
    
                let id = btn.id
    
                if (btn.getAttribute('data-mute') != 'muted') {
                    sample[id].muted = true
                    btn.dataset.mute = 'muted'
                    btn.firstElementChild.src = '../assets/img/audio/audio-icon-muted.svg'
    
                } else {
                    sample[id].muted = false
                    btn.dataset.mute = ''
                    btn.firstElementChild.src = '../assets/img/audio/audio-icon.svg'
                }
    
            })
    
        })
    }, 1000);
   

}