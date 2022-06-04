<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <title>Carico Lavoro</title>
</head>
<body>
    <header>
        <h1>Carico Lavoro</h1>
    </header> 
    <main>
        <h2>Nuovo Carivo lavoro</h2>
        <section class="carico">
            <div class="carico__data">
                <label for="giorno">Giorno</label>
                <input type="date" name="giorno" id="giorno">
            </div>
            <div class="carico__ore">
                <label for="inizio">Inizio</label>
                <input type="time" name="inizio" id="inizio">
                <label for="inizio">Fine</label>
                <input type="time" name="inizio" id="inizio">
            </div>
            <div class="carioco__dati">
                <label for="rpe">Rpe</label>
                <select name="rpe" id="rep">
                    <option value="6">6</option>
                    <option value="6.5">6,5</option>
                    <option value="7">7</option>
                    <option value="7.5">7,5</option>
                    <option value="8">8</option>
                    <option value="8.5">8,5</option>
                    <option value="9">9</option>
                </select>
                <label for="allenamento">Allenamento</label>
                <select name="allenamento" id="allenamento">
                    <option value="">WL</option>
                    <option value="">PL</option>
                    <option value="">ROW</option>
                    <option value="">RUN</option>
                </select>
                <label for="tipo">Tipo Allenamento</label>
                <select name="tipo" id="tipo">
                    <option value="allenamento" select>Allenamento</option>
                    <option value="gara">Gara</option>
                </select>
            </div>
        </section>
    </main>
</body>
</html>