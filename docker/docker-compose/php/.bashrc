alias ls='ls --color=auto'
alias ll='ls -alF'

#Ajuda Cores
#'\033' :octal de escape (necessário para começar o comando de cores)
#0;     :sem estilo, o texto não está nem em negrito nem itálico
#1;     :negrito
#32m    :código da cor verde

#cores
SEM_COR='\[\033[0m\]'
#VERDE='\033[0;32m'
#AZUL='\033[0;34m'

#cores em negrito
NROSA='\[\033[1;35m\]'
NAMARELO='\[\033[1;33m\]'
NAZUL='\[\033[1;34m\]'

PS1="${NROSA}\u ${NAZUL}\w${NVERMELHO}${SEM_COR}\$ "
unset SEM_COR NROSA NAMARELO NAZUL
cat<<'EOF'
           _..._
         .'     '.
        /  _   _  \
        | (o)_(o) |
         \(     ) /
         //'._.'\ \
        //   .   \ \
       ||   .     \ \
       |\   :     / |
       \ `) '   (`  /_
     _)``".____,.'"` (_
     )     )'--'(     (
      '---`      `---`

EOF
echo "Versão do PHP $(php -r 'echo PHP_VERSION;')"
echo "===================="
