import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.HomePage;
import pages.RegisterPage;

import java.util.concurrent.TimeUnit;
import static org.junit.jupiter.api.Assertions.*;

public class TestRegister {

    static WebDriver webDriver;

    @BeforeAll
    public static void SetUp(){
        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");
    }

    @AfterAll
    public static void endTest(){
        webDriver.close();
    }

    @Test
    public void testRegister() {
        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        RegisterPage registerPage = homePage.clickRegister();
        WebElement signupTitle = registerPage.findSignupTitle();
        assertEquals("Sign Up", signupTitle.getText());

        // spatne vyplnene udaje
        registerPage.fillOutForm("Cu", "dfafsdf@", "ctiměřice24", "ahoj1", "neahoj2" );
        registerPage.sendForm();
        signupTitle = registerPage.findSignupTitle();
        assertEquals("Sign Up", signupTitle.getText());

        //spravne vyplneno
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        registerPage.clearInputs();
        registerPage.fillOutForm("Pikachu", "Pikachu@pokemon.com", "Pikaaachuuuu", "TS1ahoj!", "TS1ahoj!");
        registerPage.sendForm();
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

    }
}
