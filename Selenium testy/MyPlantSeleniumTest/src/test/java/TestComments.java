import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.HomePage;
import pages.LoginPage;
import pages.PostsPage;
import pages.SelectedPostPage;

import java.util.concurrent.TimeUnit;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertNotEquals;


public class TestComments {

    static WebDriver webDriver;
    static HomePage homePage;
    static WebElement introTitle;
    static LoginPage loginPage;

    @BeforeAll
    public static void SetUp(){

        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");

        homePage = new HomePage(webDriver);
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        loginPage = homePage.clickLogin();
        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

    }

    @Test
    public void testCreateComment() {

        PostsPage postsPage = homePage.clickPosts();
        WebElement postsTitle = postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        SelectedPostPage selectedPostPage = postsPage.clickReadMore();

        // spatne vyplnene udaje
        selectedPostPage.fillOutForm("Cu", "dfafsdf@", "ctiměřice24");
        selectedPostPage.sendForm();

        //spravne vyplneno
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        selectedPostPage.clearInputs();
        selectedPostPage.fillOutForm("Olesinkka", "Chereole1@espargadoj.org", "Chereolenlka");
        selectedPostPage.sendForm();

        String lastCommentName = selectedPostPage.getLastCommentName().getText();
        String lastBody = selectedPostPage.getLastBody().getText();

        //opet spravne vyplneno
        webDriver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
        selectedPostPage.clearInputs();
        selectedPostPage.fillOutForm("Zlykvetinar", "Kytkohub@seynam.org", "nemám rád kytky, jsou zlé");
        selectedPostPage.sendForm();

        String newLastCommentName = selectedPostPage.getLastCommentName().getText();
        String newLastBody = selectedPostPage.getLastBody().getText();

        assertNotEquals(lastCommentName, newLastCommentName);
        assertNotEquals(lastBody, newLastBody);

    }

}
